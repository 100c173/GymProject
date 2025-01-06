<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\MembershipApplication;
use App\Models\Service;
use App\Models\Session;
use App\Models\SportEquipment;
use App\Models\Subscription;
use App\Models\User;

class DashboardService
{

    public function getInfo()
    {
        return [
            'users' => $this->countUsersWithRole('user'),
            'admins' => $this->countUsersWithRole('admin'),
            'trainers' => $this->countUsersWithRole('trainer'),
            'new_membership_applications' => $this->countNewMembershipApplications(),
            'services' => $this->countServices(),
            'sessions' => $this->countSessions(),
            'appointments' => $this->countAppointments(),
            'equipments' => $this->countEquipments(),
            'subscriptions' => $this->countTotalSubscriptions(),
            'total_sales' => $this->calculateTotalSales(),

        ];
    }

    public function countUsersWithRole($role)
    {
        return User::role($role)->count();
    }
    public function countNewMembershipApplications()
    {
        return MembershipApplication::whereDate('created_at', today())->count();
    }
    public function countServices()
    {
        return Service::count();
    }
    public function countSessions()
    {
        return Session::count();
    }
    public function countAppointments()
    {
        return Appointment::count();
    }
    public function countEquipments()
    {
        return SportEquipment::count();
    }
    private function calculateTotalSales()
    {
        $totalSales = Subscription::join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->whereMonth('subscriptions.start', now()->month)
            ->sum('plans.price');

        return number_format($totalSales, 2, '.', ',');
    }
    private function countTotalSubscriptions()
    {
        return Subscription::whereMonth('start', now()->month)->count();
    }
}
