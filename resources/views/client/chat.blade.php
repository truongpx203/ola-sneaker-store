@extends('client.layout')
@push('styles')
    <style>
        #users > li {
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height: 45vh">
                                    </ul>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" id="message" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary w-100">Gửi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <p><strong>Người dùng Online</strong></p>
                            <ul
                                id="users"
                                class="list-unstyled overflow-auto text-info"
                                style="min-height: 45vh"
                            >
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="module">
    const usersElement = document.getElementById('users')
    const messagesElement = document.getElementById('messages')
    Echo.join('chat')
        .here((users) => {
            users.forEach((user, index) => {
                const element = document.createElement('li')
                element.setAttribute('id', user.id)
                element.setAttribute('onclick', `greetUser("${user.id}")`)
                element.innerText = user.name

                usersElement.appendChild(element)
            })
        })
        .joining((user) => {
            const element = document.createElement('li')
            element.setAttribute('id', user.id)
            element.setAttribute('onclick', `greetUser("${user.id}")`)
            element.innerText = user.name

            usersElement.appendChild(element)
        })
        .leaving((user) => {
            const element = document.getElementById(user.id)
            element.parentNode.removeChild(element)
        })
        .listen('MessageSent', (e) => {
            const element = document.createElement('li')
            element.innerText = e.user.name + ': ' + e.message;

            messagesElement.appendChild(element)
        })
</script>

<script type="module">
    // const messageElement = document.getElementById('message')
    // const sendElement = document.getElementById('send')

    // sendElement.addEventListener('click', (e) => {
    //     e.preventDefault();

    //     window.axios.post('/chat/message', {
    //         message: messageElement.value
    //     })

    //     messageElement.value = ""
    // });
    document.addEventListener('DOMContentLoaded', () => {
    const messageElement = document.getElementById('message');
    const sendElement = document.getElementById('send');

    if (sendElement) {
        sendElement.addEventListener('click', (e) => {
            e.preventDefault();

            window.axios.post('/chat/message', {
                message: messageElement.value
            });

            messageElement.value = "";
        });
    } else {
        console.error("Element with id 'send' not found in DOM.");
    }
});
</script>
<script>
    function greetUser(id){
        window.axios.post('/chat/greet/'+id);
    }
</script>
<script type="module">

    const messagesElement = document.getElementById('messages')

    Echo.private('chat.greet.{{auth()->user()->id}}')
        .listen('GreetingSent', (e) => {
            const element = document.createElement('li')
            element.innerText = e.message
            element.classList.add('text-success')

            messagesElement.appendChild(element)
        })
</script>

