@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="main section">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-row">
                @include('profile.include.aside')
                <main>
                    <div class="form">
                        <h1 class="h5">{!! __('Licenses') !!}</h1>
                        <p class="help-text">
                            {!! __('Licenses are valid for an entire major release "series". In other words, a license entitles you to all updates until the next series release. The current series is GoDesk Orion (initially released Feb 2021) and includes GoDesk 1.++.<br><br> Many minor updates are made throughout a series release and all of those updates are free to existing customers. Each license may only be used on a single site.<br><br> GoDesk with all updates and additions are free now. Subject to payment changes in the next "series" of the issue.') !!}
                        </p>
                        <button type="button" class="licence-btn btn btn-primary" data-toggle="modal" data-target="#licenseModal">{!! __('Purchase New License') !!}</button>
                    </div>
                    <div class="form">
                        <h2 class="h5">{!! __('Your Licenses') !!}</h2>
                        @if($entity->user->licenses->count())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{!! __('License Name') !!}</th>
                                    <th scope="col">{!! __('Series') !!}</th>
                                    <th scope="col">{!! __('Type') !!}</th>
                                    <th scope="col">{!! __('Purchase Date') !!}</th>
                                    <th scope="col">{!! __('Status') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entity->user->licenses as $license)
                                    <tr>
                                        <th scope="row">
                                            <form class="renameLicense" method="POST" action="{{ route('profile.rename-license') }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{!! $license->id !!}"/>
                                                <input type="text" class="form-control" name="name" placeholder="{!! __('License Name') !!}" value="{!! $license->name !!}">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    {!! __('Save') !!}
                                                </button>
                                            </form>
                                        </th>
                                        <td>v{!! $license->series !!}</td>
                                        <td>{!! __(\Illuminate\Support\Str::title($license->type)) !!}</td>
                                        <td>{!! date('M j, Y', strtotime($license->purchased_at)) !!}</td>
                                        <td>{!! __(\Illuminate\Support\Str::title($license->status)) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="help-text m-0">{!! __('No Licenses') !!}</p>
                        @endif
                    </div>
                    @if($entity->releases->count())
                        <div class="form">
                            <h2 class="h5">{!! __('Releases') !!}</h2>
                            <ul class="releases">
                                @foreach($entity->releases as $release)
                                    <li class="release">
                                        <div class="header">
                                            <div>
                                                @if($entity->user->licenses->max('series') >= intval($release->version))
                                                    <a class="h5 version text-primary" target="_blank" href="{!! route('profile.release', ['version' => $release->version]) !!}">v{!! $release->version !!}</a>
                                                @else
                                                    <h5 class="d-inline-block p-0 m-0 version text-muted">v{!! $release->version !!}</h5>
                                                @endif
                                                <p>{!! __('Released') !!} {!! date('M Y', strtotime($release->created_at)) !!}</p>
                                                @if($entity->user->licenses->max('series') < intval($release->version))
                                                    <p class="text-danger notallow">{!! __('Your license does not allow this version. Renew your license or buy a new one.') !!}</p>
                                                @endif
                                            </div>
                                            @if($entity->user->licenses->max('series') >= intval($release->version))
                                                <a class="btn btn-primary btn-sm download" target="_blank" href="{!! route('profile.release', ['version' => $release->version]) !!}">{!! __('Download') !!}</a>
                                            @endif
                                        </div>
                                        <div class="markdown">
                                            {!! $release->content !!}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger animated fadeInDown" data-notify="container" role="alert">
            @if ($errors->has('name'))
                {{ $errors->first('name') }}
            @endif
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success animated fadeInDown" data-notify="container" role="alert">
            {!! session()->get('success') !!}
        </div>
    @endif
    <div class="modal fade" id="licenseModal" tabindex="-1" role="dialog" aria-labelledby="licenseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="licenseModalLabel">{!! __('New License') !!}</h5>
                </div>
                <form class="form" method="POST" action="{{ route('profile.new-license') }}">
                    <div class="modal-body">
                        <div class="form-div mb-3">
                            <label for="inputName" class="form-label">{!! __('Url') !!}</label>
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="{!! __('Enter your domain name') !!}">
                            <div class="invalid-feedback hide"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">{!! __('Close') !!}</button>
                        <button type="submit" id="licenseModalSubmit" class="btn btn-sm btn-primary">{!! __('Purchase') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop