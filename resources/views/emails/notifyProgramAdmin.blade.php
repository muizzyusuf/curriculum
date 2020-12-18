@component('mail::message')

# You have been made a program administrator

A program administrator has made you a collaborator in their program project through the UBC Curriculum Alignment Tool. Please log in to see the program and make edits under the “My Programs” section.

@component('mail::button', ['url' => 'https://curriculum.ok.ubc.ca/login'])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
