<style>
    *{
        font: 1em sans-serif;
    }

    .strong{
        font-weight: bold;
    }

</style>

<h2>Dear {{$appointment->client->first_name}} {{$appointment->client->last_name}},</h2>
<p>
you have new appointment to: <span class="strong">{{$appointment->slot->employee->first_name}} {{$appointment->slot->employee->last_name}}</span><br>
<br>
at: <span class="strong">{{$appointment->slot->date_from}}</span><br>
<br>
Do not forget your pet at home, please.<br>
</p>
Kind regards,<br>
<span class="strong">VET team</span><br>
