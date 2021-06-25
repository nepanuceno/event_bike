<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{


    public function getNotificationsTenantJoin()
    {

        $dropdownHtml = '';
        $user = Auth::user();
        $notifications = $user->received_notifies;
        $photo = isset($user->photo) ? 'storage/photos/'.$user->photo : '/system_images/photo-less.jpg';

        foreach($notifications as $key=>$notify) {
            $dropdownHtml .= "<a href='#' class='dropdown-item'>";
            $dropdownHtml .= "<div class=\"media\">
                                <img src=\"". $photo ."\" alt=\"Photo\" class=\"img-size-50 mr-3 img-circle\">
                                <div class=\"media-body\">
                                <h3 class=\"dropdown-item-title\">
                                    {$notify->sending_user->name}
                                </h3>";
                                $dropdownHtml .= "<p class=\"text-sm\">Solicitação de acesso!";
                                $dropdownHtml .= "<p class=\"text-sm\"><".$notify->requested_tenant->name."</p>";
            $dropdownHtml .= "</div>";
            $dropdownHtml .= "</div>";
            $dropdownHtml .= "</a>";
            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }
    /**
     * Get the new notification data for the navbar notification.
     *
     * @param Request $request
     * @return Array
     */
    public function getNotificationsData(Request $request)
    {
        // For the sake of simplicity, assume we have a variable called
        // $notifications with the unread notifications. Each notification
        // have the next properties:
        // icon: An icon for the notification.
        // text: A text for the notification.
        // time: The time since notification was created on the server.
        // At next, we define a hardcoded variable with the explained format,
        // but you can assume this data comes from a database query.

        $notifications = [
            [
                'icon' => 'fas fa-fw fa-envelope',
                'text' => rand(0, 10) . ' new messages',
                'time' => rand(0, 10) . ' minutes',
            ],
            [
                'icon' => 'fas fa-fw fa-users text-primary',
                'text' => rand(0, 10) . ' friend requests',
                'time' => rand(0, 60) . ' minutes',
            ],
            [
                'icon' => 'fas fa-fw fa-file text-danger',
                'text' => rand(0, 10) . ' new reports',
                'time' => rand(0, 60) . ' minutes',
            ],
        ];

        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                    {$not['time']}
                    </span>";

            $dropdownHtml .= "<a href='#' class='dropdown-item'>
                                {$icon}{$not['text']}{$time}
                            </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }
}
