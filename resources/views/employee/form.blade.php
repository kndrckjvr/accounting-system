<div class="form-group">
    <label for="employee_name">Name</label>
    <input type="text" name="name" id="name" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : '' }}" value="{{ old('name') ?? $employee->name }}" />
    @if($errors->has('name'))
    <span class="invalid-feedback">
        {{$errors->first('name')}}
    </span>
    @endif
</div>
<div class="form-group">
    <label for="basic_pay">Basic Pay</label>
    <input type="text" name="basic_pay" id="basic_pay" class="form-control{{ ($errors->has('basic_pay')) ? ' is-invalid' : '' }}" value="{{ old('basic_pay') ?? ($employee->basic_pay == null) ? '' : $employee->basic_pay->amount }}">
    @if($errors->has('basic_pay'))
    <span class="invalid-feedback">
        {{$errors->first('basic_pay')}}
    </span>
    @endif
</div>
<div class="form-group">
    <label for="branch">Branch</label>
    <select class="form-control" name="branch_id" id="branch_id">
        @if($branches === null)
        <option value="">No Branches Found!</option>
        @else
        @foreach($branches as $branch)
        <option value="{{$branch->id}}"@if($employee->branch != null) {{ $employee->branch->id == $branch->id ? ' selected' : ''}} @endif>{{$branch->name}}</option>
        @endforeach
        @endif
    </select>
    @if($errors->has('branch_id'))
    <span class="invalid-feedback">
        {{$errors->first('branch_id')}}
    </span>
    @endif
</div>