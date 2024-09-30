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
        position: absolute;
        width: calc(100% - 20px);
        max-width: 800px;
        height: 500px;
        border-radius: 10px;
        background-color: #fff;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background-color: #f0f0f0;
        overflow: hidden;
    }

    .top_menu {
        background-color: #4a4a4a;
        width: 100%;
        padding: 20px 0 15px;
        box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
        color: white;
        text-align: center;
    }

    .top_menu .title {
        font-size: 20px;
        font-weight: 500;
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
        align-items: flex-start;
    }

    .messages .message.right {
        justify-content: flex-end;
    }

    .messages .message .text_wrapper {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 15px;
        background-color: #ececec;
        display: inline-block;
        font-size: 16px;
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
        transition: border-color 0.3s ease;
    }

    .bottom_wrapper .message_input:focus {
        border-color: #4a90e2;
    }

    .bottom_wrapper .send_message {
        background-color: #4a90e2;
        border: none;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .bottom_wrapper .send_message:hover {
        background-color: #357ab7;
    }
</style>

<div class="container chat_window">
    <div class="row">
        <div class="col-sm-12">
            <ul id="chat" class="messages">
                @foreach ($messages as $message)
                    @if (Auth::guard('client')->check())
                        <li class="message {{ $message->sender_id == Auth::guard('admin')->id() ? 'right' : 'left' }}">
                            <div class="text_wrapper">
                                <div class="text">
                                    {{-- <strong>{{ $message->sender_id == Auth::guard('client')->id() ? 'Vous' : $client->pseudo }}:</strong> --}}
                                    {{ $message->message }}
                                </div>
                            </div>
                        </li>
                    @elseif (Auth::guard('admin')->check())
                        <li class=" message {{ $message->sender_id == Auth::guard('client')->id() ? 'right' : 'left' }}">
                            <div class="bg-primary text-white text_wrapper">
                                <div class="fw-4 fs-6 text">
                                    {{-- <strong>{{ $message->sender_id == Auth::guard('admin')->id() ? 'Vous' : $admin->name }}:</strong> --}}
                                    {{ $message->message }}
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="bottom_wrapper">
                @if (Auth::guard('admin')->check())
                    <form method="POST" action="{{ route('chat.sendMessageClient', $client->id) }}">
                        @csrf
                        <div class="d-flex flex-row">
                            <input type="text" name="message" class="message_input w-100"
                                placeholder="Écrivez votre message ici..." />
                            <button style="background-color: blueviolet;" type="submit" class="send_message">Envoyer</button>
                        </div>
                    </form>
                @elseif (Auth::guard('client')->check())
                    <form method="POST" action="{{ route('chat.sendMessage', $admin->id) }}">
                        @csrf
                        <div class="d-flex flex-row">
                            <input type="text" name="message" class="message_input w-100"
                                placeholder="Écrivez votre message ici..." />
                            <button type="submit" class="send_message">Envoyer</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials.nav')
@include('partials.footer')
