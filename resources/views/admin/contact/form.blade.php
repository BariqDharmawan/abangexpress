<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    <div class="form-group">
        <label for="edit-contact-addres">Our address</label>
        <textarea name="address" id="edit-contact-addres" rows="4" 
        class="form-control" minlength="6" required>{{ $data->address }}</textarea>
    </div>
    <div class="form-group">
        <label for="edit-contact-url">Maps address link</label>
        <input type="url" class="form-control" inputmode="url" id="edit-contact-url" name="link_address" value="{{ $data->link_address }}" 
        title="Link should be start with 'https://'"
        pattern="^(http(s)?:\/\/)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$" required>
    </div>

    <div class="form-group">
        <label for="our-telephone">Our telephone</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">+62</div>
            </div>
            <input type="text" class="form-control" name="telephone" 
            id="our-telephone" value="{{ $data->telephone }}"
            pattern="^(?!62)(?!0)\w+$"
            title="No need to start with '62' or '0'" required>
        </div>
    </div>

    <div class="form-group">
        <label for="edit-contact-email">Our email</label>
        <input type="email" class="form-control" inputmode="email" id="edit-contact-email" name="email" value="{{ $data->email }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>