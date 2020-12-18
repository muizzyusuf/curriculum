@component('mail::message')

# You have been assigned a course to map

A fellow instructor has assigned a course to you through the UBC Curriculum Alignment Tool. Please log in to see the course and make edits under the “My Courses” section.

@component('mail::button', ['url' => 'https://curriculum.ok.ubc.ca/login'])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
