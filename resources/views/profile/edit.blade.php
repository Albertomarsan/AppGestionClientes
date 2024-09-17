@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Edición de perfil</h2>            
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8  mt-5">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        @foreach ($errors->all() as $message) 
                            <li style="color: red">{{$message}}</li>
                        @endforeach
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ url("profile/update/$customer->id") }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($customer) ? $customer->name : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="surname">Apellidos</label>
                        <input type="text" class="form-control" id="name" name="surname" value="{{ isset($customer) ? $customer->surname : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="hobbies">Hobbies</label>
                        <select id="hobbies" name="hobbies[]" multiple class="form-control select2">
                            @foreach ($hobbies as $hobbie)
                                @if(isset($customerHobbies))
                                    <option {{ in_array($hobbie->id, $customerHobbies) ? 'selected' : '' }} value="{{ $hobbie->id }}">{{ $hobbie->name }}</option>
                                @else
                                    <option value="{{ $hobbie->id }}">{{ $hobbie->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection