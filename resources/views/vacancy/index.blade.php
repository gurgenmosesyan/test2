<?php
$title = trans('www.vacancies.title');
$page = 'vacancies';

$desc = trans('www.vacancies.description');
$meta->title($title);
$meta->keywords(trans('www.homepage.keywords'));
$meta->ogTitle($title);
$meta->ogImage($background);
$meta->ogUrl(url_with_lng('/vacancies/'.$vacancy->id, false));
$desc = $title;

?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{$title}}</h1>
    </div>
</div>

<div class="page">

    <div id="vacancies" class="index">
        <table>
            <thead>
            <tr>
                <th>{{trans('www.vacancies.list.title')}}</th>
                <th>{{$vacancy->title}}</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($vacancy->term))
                    <tr>
                        <td>{{trans('www.vacancies.list.term')}}</td>
                        <td class="last">{{$vacancy->term}}</td>
                    </tr>
                @endif
                @if($vacancy->start_date != '0000-00-00')
                    <tr>
                        <td>{{trans('www.vacancies.list.start_date')}}</td>
                        <td class="last">{{strftime('%d %b %Y', strtotime($vacancy->start_date))}}</td>
                    </tr>
                @endif
                @if(!empty($vacancy->location))
                    <tr>
                        <td>{{trans('www.vacancies.list.location')}}</td>
                        <td class="last">{{$vacancy->location}}</td>
                    </tr>
                @endif
                @if(!empty($vacancy->description))
                    <tr>
                        <td>{{trans('www.vacancies.list.description')}}</td>
                        <td class="last html-content">{!!$vacancy->description!!}</td>
                    </tr>
                    <?php $desc = $vacancy->description; ?>
                @endif
                @if(!empty($vacancy->responsibilities))
                    <tr>
                        <td>{{trans('www.vacancies.list.responsibilities')}}</td>
                        <td class="last">{{$vacancy->responsibilities}}</td>
                    </tr>
                    <?php $desc = $vacancy->responsibilities; ?>
                @endif
                @if(!empty($vacancy->qualifications))
                    <tr>
                        <td>{{trans('www.vacancies.list.qualifications')}}</td>
                        <td class="last">{{$vacancy->qualifications}}</td>
                    </tr>
                    <?php $desc = $vacancy->qualifications; ?>
                @endif
                @if(!empty($vacancy->procedures))
                    <tr>
                        <td>{{trans('www.vacancies.list.procedures')}}</td>
                        <td class="last">{{$vacancy->procedures}}</td>
                    </tr>
                    <?php $desc = $vacancy->procedures; ?>
                @endif
                @if($vacancy->open_date != '0000-00-00')
                    <tr>
                        <td>{{trans('www.vacancies.list.open_date')}}</td>
                        <td class="last">{{strftime('%d %b %Y', strtotime($vacancy->open_date))}}</td>
                    </tr>
                @endif
                @if($vacancy->deadline != '0000-00-00')
                    <tr>
                        <td>{{trans('www.vacancies.list.deadline')}}</td>
                        <td class="last">{{strftime('%d %b %Y', strtotime($vacancy->deadline))}}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
<?php
$meta->description($desc);
$meta->ogDescription($desc);
?>

@stop
