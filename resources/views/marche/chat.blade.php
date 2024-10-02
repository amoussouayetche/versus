@include('partials.head')
@include('partials.header')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Calibri", "Roboto", sans-serif;
        background-color: #fff;
    }

    .chat_window {
        border-radius: 10px;
        background-color: #f0f0f0;
        overflow: hidden;
    }

    .top_menu {
        background-color: #4a4a4a;
        width: 100%;
        padding: 20px 0 15px;
        color: white;
        text-align: center;
    }

    .messages {
        list-style: none;
        padding: 20px;
        margin: 0;
        height: 350px;
        overflow-y: auto;
        background-color: #fff;
    }

    .messages .message {
        display: flex;
        margin-bottom: 15px;
    }

    .messages .message.right {
        justify-content: flex-end;
    }

    .messages .message .text_wrapper {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 15px;
        background-color: #ececec;
        color: #333;
        margin-left: 10px;
    }

    .messages .message.right .text_wrapper {
        background-color: #4a90e2;
        color: #fff;
        margin-left: 0;
        margin-right: 10px;
    }

    .bottom_wrapper {
        width: 100%;
        padding: 10px;
        background-color: #fff;
        display: flex;
        align-items: center;
    }

    .bottom_wrapper .message_input {
        flex: 1;
        padding: 15px;
        border-radius: 25px;
        border: 1px solid #ddd;
        outline: none;
        font-size: 16px;
        margin-right: 10px;
    }

    .bottom_wrapper .send_message {
        background-color: #4a90e2;
        border: none;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .bottom_wrapper .send_message:hover {
        background-color: #357ab7;
    }
</style>

<div class="container chat_window" style="margin-top: 60px; margin-bottom: 60px;">
    <div class="row">
        <div class="col-sm-12">
            <ul id="chat" class="messages">
                @foreach ($messages as $message)
                    @if (Auth::guard('client')->check())
                        <li class="message {{ $message->sender_type === 'client' ? 'right' : 'left' }}">
                        @elseif(Auth::guard('admin')->check())
                        <li class="message {{ $message->sender_type === 'admin' ? 'right' : 'left' }}">
                    @endif
                    <div class="text_wrapper">
                        <div class="text">
                            <strong>{{ $message->sender_type === (Auth::guard('client')->check() ? 'client' : 'admin') ? 'Vous' : ($message->sender_type === 'client' ? $client->pseudo : $admin->name) }}:</strong>
                            {{ $message->message }}
                        </div>
                    </div>
                    </li>
                @endforeach
            </ul>

            <div class="bottom_wrapper">
                @if (Auth::guard('admin')->check())
                    <form method="POST" action="{{ route('chat.sendMessageClient', $client->id) }}">
                        @csrf
                        <input type="text" name="message" class="message_input"
                            placeholder="Écrivez votre message ici..." required />
                        <button type="submit" class="send_message">Envoyer</button>
                    </form>
                @elseif (Auth::guard('client')->check())
                    <form method="POST" action="{{ route('chat.sendMessage', $admin->id) }}">
                        @csrf
                        <input type="text" name="message" class="message_input"
                            placeholder="Écrivez votre message ici..." required />
                        <button type="submit" class="send_message">Envoyer</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials.nav')
@include('partials.footer')
