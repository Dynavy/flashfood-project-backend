<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MailHeader extends Component
{
    public function render()
    {
        return view('components.mail.mail-header');
    }
}
