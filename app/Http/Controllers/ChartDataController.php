<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/20
 * Time: 17:28
 */

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Carbon\Carbon;

class ChartDataController
{
    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function userDayUp()
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
    $createDate = User::all(['created_at'])->toArray();//二维数组

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

    return json_encode([
        'labels' => $labels,
        'data' => $count
    ]);
}

    public function userMonthUp()
    {
        $fourMonthAgo = Carbon::today()->subMonths(4)->toDateString();
        $threeMonthAgo = Carbon::today()->subMonths(3)->toDateString();
        $twoMonthAgo = Carbon::today()->subMonths(2)->toDateString();
        $oneMonthAgo = Carbon::today()->subMonths(1)->toDateString();
        $month = Carbon::today()->toDateString();

        $labels = [
            $this->subMonth($fourMonthAgo),
            $this->subMonth($threeMonthAgo),
            $this->subMonth($twoMonthAgo),
            $this->subMonth($oneMonthAgo),
            $this->subMonth($month)
        ];
        $createDate = User::all(['created_at'])->toArray();//二维数组

        $fourMonthAgoCount = 0;
        $threeMonthAgoCount = 0;
        $twoMonthAgoCount = 0;
        $oneMonthAgoCount = 0;
        $monthCount = 0;

        foreach ($createDate as $value)
        {
            $time = substr($value['created_at'],0,7);
            if ($this->subMonth($fourMonthAgo) == $time)
            {
                $fourMonthAgoCount++;
            }elseif ($this->subMonth($threeMonthAgo) == $time)
            {
                $threeMonthAgoCount++;
            }elseif ($this->subMonth($twoMonthAgo) == $time)
            {
                $twoMonthAgoCount++;
            }elseif ($this->subMonth($oneMonthAgo) == $time)
            {
                $oneMonthAgoCount++;
            }elseif ($this->subMonth($month) == $time)
            {
                $monthCount++;
            }
        }

        $data = [$fourMonthAgoCount,$threeMonthAgoCount,$twoMonthAgoCount,$oneMonthAgoCount,$monthCount];

        return json_encode([
            'labels' => $labels,
            'data' => $data
        ]);
}

    protected function sexCount($sex)
    {
        return Profile::all()->where('sex','=',$sex)->count();
    }

    protected function subMonth($month)
    {
        return substr($month,0,7);
    }
}