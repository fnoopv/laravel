<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/20
 * Time: 17:28
 */

namespace App\Admin\Controllers;

use App\Profile;
use App\User;
use Carbon\Carbon;

class ChartDataController
{
    public function sex()
    {
        $data = [
            'sex' => [
                '男','女','保密'
            ],
            'count' => [
                $this->sexCount('1'),
                $this->sexCount('2'),
                $this->sexCount('3'),
            ]
        ];
        return json_encode($data);
    }

    public function userUp()
    {
        $fourDaysAgo = Carbon::today()->subDays(4)->toDateString();
        $threeDaysAgo = Carbon::today()->subDays(3)->toDateString();
        $TwoDaysAgo = Carbon::today()->subDays(2)->toDateString();
        $yesterday = Carbon::today()->subDays(1)->toDateString();
        $today = Carbon::today()->toDateString();

        $labels = [
            $fourDaysAgo,
            $threeDaysAgo,
            $TwoDaysAgo,
            $yesterday,
            $today
        ];
        $createDate = User::all(['created_at'])->toArray();

        $fourDaysAgoCount = 0;
        $threeDaysAgoCount = 0;
        $TwoDaysAgoCount = 0;
        $yesterdayCount = 0;
        $todayCount = 0;

        foreach ($createDate as $value)
        {
            $time = substr($value['created_at'],0,10);
            if ($fourDaysAgo == $time)
            {
                $fourDaysAgoCount++;
            }elseif ($threeDaysAgo == $time)
            {
                $threeDaysAgoCount++;
            }elseif ($TwoDaysAgo == $time)
            {
                $TwoDaysAgoCount++;
            }elseif ($yesterday == $time)
            {
                $yesterdayCount++;
            }elseif ($today == $time)
            {
                $todayCount++;
            }
        }

        $count = [$fourDaysAgoCount,$threeDaysAgoCount,$TwoDaysAgoCount,$yesterdayCount,$todayCount,$createDate];

        return json_encode([$labels,$count]);
    }

    protected function sexCount($sex)
    {
        return Profile::all()->where('sex','=',$sex)->count();
    }
}