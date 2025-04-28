@extends('layouts.master')

@section('title')
    AMID
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            @lang('app.courses')
        @endslot
        @slot('title')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <section>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="d-flex justify-content-between" style="margin:15px">
                                <a href="{{ url('mycertifications') }}" class="btn btn-primary waves-effect">
                                    <i class="bx bx-arrow-back"></i> Go Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @php
                $url = $resource->url;
                $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));

                function getVideoEmbedUrl($url)
                {
                    if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
                        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)|.*[?&]v=)|youtu\.be/)([^"&?/\\s]{11})%i';
                        preg_match($pattern, $url, $matches);
                        $youtube_id = $matches[1] ?? null;
                        return $youtube_id ? "https://www.youtube.com/embed/{$youtube_id}?rel=0&controls=1&modestbranding=1" : null;
                    }

                    if (str_contains($url, 'vimeo.com')) {
                        $vimeo_id = basename(parse_url($url, PHP_URL_PATH));
                        return "https://player.vimeo.com/video/{$vimeo_id}";
                    }

                    return null;
                }

                $isVideoFile = in_array($extension, ['mp4', 'm4v']);
                $isPdf = $extension === 'pdf';
                $isDocx = $extension === 'docx';
                $isPpt = in_array($extension, ['ppt', 'pptx']);
                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                $embed_url = ($resource->type === 'video' && !$isVideoFile) ? getVideoEmbedUrl($url) : null;
            @endphp

            <section class="d-flex justify-content-center" style="min-height: 100vh;">
                @if($isPdf || $isDocx)
                    <iframe src="{{ $url }}#toolbar=0" allowfullscreen loading="lazy"
                        style="width: 100%; max-width: 1200px; height: 75vh; border: none;">
                    </iframe>

                    @if($isPpt)
                        <iframe src="https://docs.google.com/gview?url={{ urlencode($url) }}&embedded=true"
                            style="width: 100%; max-width: 1200px; height: 75vh; border: none;"
                            frameborder="0">
                        </iframe>
                @elseif($resource->type === 'video')
                    @if($isVideoFile)
                        <video controls style="width: 100%; max-width: 800px; border-radius: 8px;" preload="metadata">
                            <source src="{{ $url }}" type="video/{{ $extension }}">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($embed_url)
                        <div style="width: 80%; max-width: 800px;">
                            <iframe src="{{ $embed_url }}" frameborder="0" allowfullscreen
                                style="width: 100%; aspect-ratio: 16/9;">
                            </iframe>
                        </div>
                    @else
                        <p class="text-danger">Invalid video URL</p>
                    @endif

                @elseif($isImage)
                    <img src="{{ $url }}" alt="Media Image"
                        style="width: 80%; max-width: 800px; height: auto; border-radius: 8px;">

                @else
                    <p class="text-danger">Unsupported resource type: {{ $resource->type }}</p>
                @endif
            </section>
        </div>
    </div>
@endsection
