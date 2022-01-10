@extends('khapu-filemanager::layout')
@section('title', 'Dashboard')
@section('content')
@parent

<div class="container">
    <div class="grct">
        <div class="grct-left">
            <div class="grct-folder">
                <p class="name">Folder</p>
                <div class="list-fol">
                    <div class="item-folder">
                        <p class="name">
                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                            <a href="">Storage</a>
                        </p>
                        <div class="folder-submenu">
                            <a href="#">Folder 1</a>
                            <a href="#">Folder 2</a>
                            <a href="#">Folder 3</a>
                            <a href="#">Folder 4</a>
                            <a href="#">Folder 5</a>
                        </div>
                        <span class="btn-show"><i class="fa fa-plus"></i></span>
                    </div>
                    <div class="item-folder">
                        <p class="name">
                            <i class="fa fa-folder" aria-hidden="true"></i>
                            <a href="">Cloud</a>
                        </p>
                        <div class="folder-submenu">
                            <a href="#">Folder 1</a>
                            <a href="#">Folder 2</a>
                            <a href="#">Folder 3</a>
                            <a href="#">Folder 4</a>
                            <a href="#">Folder 5</a>    
                        </div>
                        <span class="btn-show"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
            </div>
            <div class="grct-tags">
                <p class="name">tags</p>
                <div class="list-tags">
                    <span>Storage</span>
                    <span>Cloud </span>
                </div>
            </div>
        </div>
        <div class="grct-right index3">
            <div class="sct ">
                <!--header-->
                <div class="head-sct">
                    <div class="sct-item check-box">
                        <label class="radio-inline">
                            <input id="inputCheckAll" type="checkbox" checked=""/>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="sct-item name">
                        <p>ITEM NAME</p>
                        <span class="btn-sx">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </div>
                    <div class="sct-item size">
                        <p>size</p>
                    </div>
                    <div class="sct-item date">
                        <p>date modified</p>
                    </div>
                    <div class="sct-item upby">
                        <p>updated by</p>
                    </div>
                    <div class="btn-bars">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <div class="menu-bars">
                            <span class="details">Details</span>
                            <span class="large-icon">Large-icons</span>
                            <span class="title">Title</span>
                        </div>
                    </div>
                </div>
                <!--end header -->

                <!--content-->
                @foreach($folders as $folder)
                    <div class="content-sct">
                        <div class="sct-item check-box">
                            <label class="radio-inline">
                                <input
                                    type="checkbox"
                                    checked=""
                                />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="sct-item name">
                            @switch($folder->type->synthetic) 
                                @case('image') 
                                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                    @break
                                @case('video')
                                    <i class="fa fa-file-video-o" aria-hidden="true"></i>
                                    @break
                                @case('text')
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    @break
                                @case('application')
                                    @switch($folder->type->detail)
                                        @case('vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                            @break
                                        @case('vnd.openxmlformats-officedocument.presentationml.presentation')
                                            <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                                            @break;
                                        @case('zip')
                                        @case('x-rar')
                                            <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                            @break
                                        @default
                                            <i class="fa fa-folder" aria-hidden="true"></i>
                                            @break
                                    @endswitch        
                                    @break
                                @case('audio')
                                    <i class="fa fa-file-audio-o" aria-hidden="true"></i>
                                    @break
                                @case('press')
                                    @break
                                @default
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    @break
                            @endswitch
                            <p><a href="{{asset("khapu-manage-files/" . $folder->subPath)}}">{{$folder->name}}</a></p>
                            <span class="btn-sx"></span>
                        </div>
                        <div class="sct-item size">
                            <p>{{$folder->size}} {{$folder->unitSize}}</p>
                        </div>
                        <div class="sct-item date">
                            <p>{{$folder->modifiedAt}}</p>
                        </div>
                        <div class="sct-item upby">
                            <p>-</p>
                        </div>
                    </div>
                @endforeach
                <!--end content -->
            </div>
        </div>
    </div>
</div>

@endsection