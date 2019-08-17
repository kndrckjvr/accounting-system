<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : '' }}" value="{{ old('name') ?? $deduction->name }}" />
    @if($errors->has('name'))
    <span class="invalid-feedback">
        {{$errors->first('name')}}
    </span>
    @endif
</div>
<div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" id="amount" class="form-control{{ ($errors->has('amount')) ? ' is-invalid' : '' }}" value="{{ old('amount') ?? ($deduction->amount == null) ? '' : $deduction->amount }}">
    @if($errors->has('amount'))
    <span class="invalid-feedback">
        {{$errors->first('amount')}}
    </span>
    @endif
</div>
<div class="form-group">
    <label for="type">Deduction Type</label>
    <select name="type" id="type" class="form-control{{ ($errors->has('type')) ? ' is-invalid' : '' }}">
        @foreach($deduction->getTypes() as $key => $value)
            <option value="{{$key}}"{{ $deduction->type == $value ? ' selected' : '' }}>{{$value}}</option>
        @endforeach
    </select>
    @if($errors->has('type'))
    <span class="invalid-feedback">
        {{$errors->first('type')}}
    </span>
    @endif
</div>
<div class="form-group form-check">
    <input type="checkbox" name="half" id="half" class="form-check-input" value="true">
    <label class="form-check-label" for="half">Semi-Monthly?</label>
</div>
<input type="hidden" name="payroll_code" value="{{$payslip->payroll_code}}">
<input type="hidden" name="employee_id" value="{{$payslip->employee->id}}">