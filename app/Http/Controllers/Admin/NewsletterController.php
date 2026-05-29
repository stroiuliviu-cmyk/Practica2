<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function index(): View
    {
        $subscribers = NewsletterSubscriber::orderByDesc('created_at')->paginate(30);
        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscriber $subscriber): RedirectResponse
    {
        $email = $subscriber->email;
        $subscriber->delete();
        return back()->with('success', 'Abonatul „' . $email . '" a fost șters.');
    }
}
