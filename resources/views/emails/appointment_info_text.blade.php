Dear {{$appointment->client->first_name}} {{$appointment->client->last_name}},


you have appointment to: {{$appointment->slot->employee->first_name}} {{$appointment->slot->employee->last_name}}
at: {{$appointment->slot->date_from}}

Do not forget your pet at home, please.

Kind regards,
VET team