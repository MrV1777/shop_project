<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard overview.
     */
    public function index()
    {
        // Get total counts
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        
        // Get recent orders
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(5)->get();

        return view('Dashboard.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'recentOrders'
        ));
    }

    /**
     * Display product analytics.
     */
    public function products()
    {
        // Get all products with their sales data
        $products = Product::all();

        // Calculate sales for each product based on orders
        $productSales = [];
        
        foreach ($products as $product) {
            $salesCount = 0;
            $orders = Order::where('items', '!=', null)->get();
            
            foreach ($orders as $order) {
                $items = is_array($order->items) ? $order->items : [];
                foreach ($items as $item) {
                    if (isset($item['product_id']) && $item['product_id'] == $product->_id) {
                        $salesCount += $item['quantity'] ?? 1;
                    }
                }
            }

            $productSales[] = [
                'product' => $product,
                'sales_count' => $salesCount,
                'revenue' => $salesCount * ($product->price ?? 0),
            ];
        }

        // Sort by sales count
        usort($productSales, function($a, $b) {
            return $b['sales_count'] - $a['sales_count'];
        });

        // Best selling products (top 5)
        $bestSelling = array_slice($productSales, 0, 5);

        // Least selling products (bottom 5)
        $leastSelling = array_slice(array_reverse($productSales), 0, 5);

        return view('Dashboard.dashboard-product', compact(
            'bestSelling',
            'leastSelling',
            'productSales'
        ));
    }

    /**
     * Display order analytics.
     */
    public function orders()
    {
        // Get all orders
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Calculate order statistics
        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $completedOrders = $orders->where('status', 'completed')->count();
        $cancelledOrders = $orders->where('status', 'cancelled')->count();
        $totalRevenue = $orders->sum('total_price');

        // Orders by payment method
        $paymentMethods = [];
        foreach ($orders as $order) {
            $method = $order->payment_method ?? 'unknown';
            if (!isset($paymentMethods[$method])) {
                $paymentMethods[$method] = 0;
            }
            $paymentMethods[$method]++;
        }

        // Orders by status
        $statusCounts = [
            'pending' => $pendingOrders,
            'completed' => $completedOrders,
            'cancelled' => $cancelledOrders,
        ];

        // Recent orders for timeline
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(10)->get();

        return view('Dashboard.dashboard-order', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalRevenue',
            'paymentMethods',
            'statusCounts',
            'recentOrders'
        ));
    }

    /**
     * Display user analytics (top purchasers).
     */
    public function users()
    {
        // Get all users
        $users = User::all();

        // Calculate purchase statistics for each user
        $userPurchases = [];
        
        foreach ($users as $user) {
            $orders = Order::where('customer_email', $user->email)->get();
            
            $totalOrders = $orders->count();
            $totalSpent = $orders->sum('total_price');
            $completedOrders = $orders->where('status', 'completed')->count();
            
            $userPurchases[] = [
                'user' => $user,
                'total_orders' => $totalOrders,
                'total_spent' => $totalSpent,
                'completed_orders' => $completedOrders,
            ];
        }

        // Sort by total orders (top purchasers)
        usort($userPurchases, function($a, $b) {
            return $b['total_orders'] - $a['total_orders'];
        });

        // Top purchasers (top 5)
        $topPurchasers = array_slice($userPurchases, 0, 5);

        // Least purchasers (bottom 5)
        $leastPurchasers = array_slice(array_reverse($userPurchases), 0, 5);

        return view('Dashboard.dashboard-user', compact(
            'topPurchasers',
            'leastPurchasers',
            'userPurchases'
        ));
    }
}
