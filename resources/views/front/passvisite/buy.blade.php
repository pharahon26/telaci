@extends('layouts.front_app')
@section('content')

<div class="container">
    <div>
        <h3 class="text-primary">Paiement du pass visite</h3>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                {{$dataPassVisite->name}}: {{$dataPassVisite->price}} F

            </div>
            <div class="col-3"></div>
        </div>
    </div>

</div>
<script language="JavaScript">
    document.goCinetPay.submit();
</script>
@endsection
