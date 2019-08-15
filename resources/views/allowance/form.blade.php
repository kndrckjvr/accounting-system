<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : '' }}" value="{{ old('name') ?? $allowance->name }}" />
    @if($errors->has('name'))
    <span class="invalid-feedback">
        {{$errors->first('name')}}
    </span>
    @endif
</div>
<div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" id="amount" class="form-control{{ ($errors->has('amount')) ? ' is-invalid' : '' }}" value="{{ old('amount') ?? ($allowance->amount == null) ? '' : $allowance->amount }}">
    @if($errors->has('amount'))
    <span class="invalid-feedback">
        {{$errors->first('amount')}}
    </span>
    @endif
</div>
<div class="form-group form-check">
    <input type="checkbox" name="tax_flag" id="tax_flag" class="form-check-input" value="true">
    <label class="form-check-label" for="tax_flag">Taxable</label>
</div>
<input type="hidden" name="payroll_code" value="{{$payslip->payroll_code}}">
<input type="hidden" name="employee_id" value="{{$payslip->employee->id}}">