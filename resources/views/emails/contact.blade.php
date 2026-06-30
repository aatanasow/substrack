<x-mail::message>

# New Contact Message

You have received a new message from your website contact form.

<x-mail::panel>

**Name:**
{{ $data['name'] }}

**Email:**
{{ $data['email'] }}

**Message:**
{{ $data['message'] }}

</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
