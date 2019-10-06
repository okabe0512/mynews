<!DOCTYPE html>

    {{-- layouts/profile.blade.phpを読み込む --}}
    @extends('layouts.profile')
        
        
    {{-- profile.blade.phpの@yield('title')に'ジコショウカイ'を埋め込む --}}
    @section('title', 'ジコショウカイ')
        
    {{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
    @section('content')
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2>プロフィール</h2>
                        <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="title">氏名(name)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別(gender)</label>
                            <div class="form-group row">
                                <label class="col-md-2" for="gender">男</label>
                                    <div class="col-md-10">
                                        <input type="radio" class="radio" name="gender" value="男性">
                                
                                    </div>
                            </div>
                    
                            <div class="form-group row">
                                <label class="col-md-2" for="gender">女</label>
                                    <div class="col-md-10">
                                        <input type="radio" class="radio" name="gender" value="女性">
                                    </div>
                            </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="title">趣味(hobby)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="title">自己紹介欄(introduction)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    
    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                        
                        
                        
                    </div>
                </div>
            </div>
        @endsection