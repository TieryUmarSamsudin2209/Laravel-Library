<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    
    public function adminDashboard()
    {
        return view('admin.index');
    }
}
?>



