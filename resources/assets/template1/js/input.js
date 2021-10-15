$(".not-allow-space").on('input', function(e) {
    this.value = this.value.replace(/ /g, '')
})