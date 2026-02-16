@extends('layoutAdmin.main')

@section('content')
@php
    $metricCards = [
        ['icon' => 'fa-book', 'label' => 'Total lesson', 'value' => number_format($lessons), 'delta' => '+' . max(1, (int) round(($lessons / max(1, $users)) * 10)) . '%', 'trend' => 'up'],
        ['icon' => 'fa-history', 'label' => 'Total activity', 'value' => number_format($activities), 'delta' => '+' . max(1, (int) round(($activities / max(1, $lessons)) * 8)) . '%', 'trend' => 'up'],
        ['icon' => 'fa-envelope-o', 'label' => 'New request', 'value' => number_format($requests), 'delta' => $requests > 0 ? '+' . min(99, $requests * 3) . '%' : '0%', 'trend' => $requests > 0 ? 'up' : 'down'],
        ['icon' => 'fa-graduation-cap', 'label' => 'Active student', 'value' => number_format($students_active), 'delta' => '+' . max(1, (int) round(($students_active / max(1, $students)) * 10)) . '%', 'trend' => 'up'],
    ];

    $maxActivity = max(1, collect($trend)->max('activity'));
    $maxRequest = max(1, collect($trend)->max('request'));
    $maxBar = max($maxActivity, $maxRequest);

    $palette = ['#5f79e9', '#5b88ef', '#67a7f4', '#6ee1b2', '#66d49f', '#b668f0', '#e95fa9', '#f29f4c', '#f4ce59', '#59cfbe'];
    $topCategories = collect($categorySummary)->take(10)->values();
    $donutStops = [];
    $offset = 0;
    foreach ($topCategories as $idx => $cat) {
        $slice = max(2, (int) $cat['percent']) / 100 * 360;
        $color = $palette[$idx % count($palette)];
        $donutStops[] = $color . ' ' . $offset . 'deg ' . ($offset + $slice) . 'deg';
        $offset += $slice;
    }
    if (empty($donutStops)) {
        $donutStops[] = '#dce4ea 0deg 360deg';
    }
@endphp

<link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/admin-dashboard-modern.css') }}">

<div class="period-note"><i class="fa fa-calendar-o"></i> {{ $periodLabel }}</div>

<div class="cards-grid">
    @foreach ($metricCards as $card)
        <div class="metric-card">
            <div class="metric-label"><i class="fa {{ $card['icon'] }}"></i> {{ $card['label'] }}</div>
            <div class="metric-value">
                {{ $card['value'] }}
                <span class="delta {{ $card['trend'] }}">
                    <i class="fa {{ $card['trend'] === 'up' ? 'fa-line-chart' : 'fa-level-down' }}"></i> {{ $card['delta'] }}
                </span>
            </div>
        </div>
    @endforeach
    <a class="metric-add" href="{{ route('admin.lesson.create') }}"><div><i class="fa fa-plus-square-o"></i><small>Add lesson</small></div></a>
</div>

<section class="panel">
    <div class="sales-top">
        <h2 class="panel-title">Tren aktivitas admin</h2>
        <div class="legend">
            <span><i class="fa fa-circle" style="color:#5f79e9;"></i>Activity</span>
            <span><i class="fa fa-circle" style="color:#f2a143;"></i>New request</span>
        </div>
    </div>

    <div class="bar-grid">
        <div class="chart-area">
            <div class="y-labels">
                <span>{{ $maxBar }}</span><span>{{ (int) ($maxBar * .85) }}</span><span>{{ (int) ($maxBar * .7) }}</span><span>{{ (int) ($maxBar * .55) }}</span><span>{{ (int) ($maxBar * .4) }}</span><span>{{ (int) ($maxBar * .25) }}</span><span>{{ (int) ($maxBar * .1) }}</span><span>0</span>
            </div>
            @foreach ($trend as $index => $bar)
                @php
                    $activityHeight = max(4, (int) round(($bar['activity'] / $maxBar) * 100));
                    $requestHeight = max(4, (int) round(($bar['request'] / $maxBar) * 100));
                @endphp
                <div class="bar-item">
                    <div class="bars">
                        <div class="bar activity" style="height: {{ $activityHeight }}%;"></div>
                        <div class="bar request" style="height: {{ $requestHeight }}%;"></div>
                    </div>
                    <div class="x-label {{ $index === count($trend) - 1 ? 'highlight' : '' }}">{{ $bar['label'] }}</div>
                </div>
            @endforeach

            <div class="tooltip-card">
                <div class="mini"><i class="fa fa-circle" style="color:#5f79e9;font-size:9px;"></i> Activity terbaru</div>
                <div class="big">{{ collect($trend)->last()['activity'] ?? 0 }} <span style="font-size:14px;color:#2da97a;font-weight:600;">hari ini</span></div>
            </div>
        </div>
    </div>
</section>

<div class="split-panels">
    <section class="panel">
        <h2 class="panel-title">Distribusi lesson per category</h2>
        <div class="cat-wrap">
            <div class="category-grid">
                @forelse ($topCategories as $index => $cat)
                    <div class="cat-item"><i class="fa fa-circle" style="color:{{ $palette[$index % count($palette)] }};"></i> {{ $cat['name'] }} - <b>{{ $cat['percent'] }}%</b></div>
                @empty
                    <div class="cat-item">Belum ada data category.</div>
                @endforelse
            </div>
            <div class="donut" style="--donut-stops: {{ implode(', ', $donutStops) }};"></div>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Monitoring request</h2>
        <div class="small-panel">
            <div class="status-grid">
                <div class="status-row"><div><span class="status-dot new"></span>New request</div><span class="badge-num">{{ $requests }}</span></div>
                <div class="status-row"><div><span class="status-dot responded"></span>Responded</div><span class="badge-num">{{ $requests_responded }}</span></div>
                <div class="status-row"><div><span class="status-dot declined"></span>Declined</div><span class="badge-num">{{ $requests_declined }}</span></div>
            </div>
        </div>

        <div class="small-panel">
            <h3 class="panel-title" style="font-size:15px;">Request terbaru</h3>
            <div class="feed-list">
                @forelse ($recentRequests as $item)
                    <div class="feed-item">
                        <p class="feed-title">#{{ $item->id }} {{ $item->topic }}</p>
                        <div class="feed-meta">{{ $item->status }} • {{ $item->date }}</div>
                    </div>
                @empty
                    <div class="feed-item"><p class="feed-title">Belum ada request.</p></div>
                @endforelse
            </div>
        </div>

        <div class="small-panel">
            <h3 class="panel-title" style="font-size:15px;">Aktivitas terbaru</h3>
            <div class="feed-list">
                @forelse ($recentActivities as $item)
                    <div class="feed-item">
                        <p class="feed-title">#{{ $item->id }} {{ \Illuminate\Support\Str::limit($item->audit_action, 55) }}</p>
                        <div class="feed-meta">{{ $item->date }}</div>
                    </div>
                @empty
                    <div class="feed-item"><p class="feed-title">Belum ada aktivitas.</p></div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
