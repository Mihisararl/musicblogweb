<x-layout>

    <h1 class="title"> Welcome back</h1>
    
            <form action="{{ route('login') }}" method="post"style="
            background-image: url('https://i.pinimg.com/originals/88/41/95/884195ec64c36b651cfd39d899d1d4ba.jpg'); 
            background-size: cover; 
             background-position: center;
            padding: 55px; 
            border-radius: 50px; 
            color: #fff;">
                @csrf


                {{-- email --}}
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="input">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                {{-- password --}}
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="input">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- remember checkbox --}}
                <div class="mb-4">
                    <input type="checkbox"name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror

                {{-- submit button --}}
                <button class="btn">Login</button>
            </form>
        </div>
    </div>
</x-layout>
