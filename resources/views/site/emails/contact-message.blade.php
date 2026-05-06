@component('mail::message')
# New Inquiry Received

A new message has been submitted via the website contact form.

**From:** {{ $contactMessage->name }}
**Email:** [{{ $contactMessage->email }}](mailto:{{ $contactMessage->email }})
**Company / Subject:** {{ $contactMessage->subject ?? 'Not provided' }}

**Message / Hardware Requirements:**
@component('mail::panel')
{{ $contactMessage->message }}
@endcomponent

@component('mail::button', ['url' => route('admin.messages.index')])
View Inbox in Admin Panel
@endcomponent

Thanks,<br>
{{ app('settings')->app_name ?? config('app.name') }} System
@endcomponent