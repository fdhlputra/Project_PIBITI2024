<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    /**
     * Handle the user search and filter.
     */
    public function search(Request $request)
    {
        $query = User::query();
        $search = $request->search;

        // for search
        if ($request->has('search') && $search != '') {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('authority', 'LIKE', '%' . $search . '%');
        }

        // for filtering
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'a-z':
                    $query->orderBy('name', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('name', 'desc');
                    break;
                case 'last-update':
                    $query->orderBy('updated_at', 'desc');
                    break;
                default:
                    break;
            }
        }

        $users = $query->get();
        if(!$users){
            $users = [];
        }

        return view('users.index', compact('users', 'search'));
    }
}
