namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        Log::info('Admin dashboard accessed');
        return view('admin.dashboard');
    }
}
