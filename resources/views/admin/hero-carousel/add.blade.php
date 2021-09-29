<x-admin.modal id="hero-carousel" heading="Header Carousel">
    <form method="POST" enctype="multipart/form-data" action="">
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" required>
                <label class="custom-file-label" for="customFile">Choose cover</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-admin.modal>