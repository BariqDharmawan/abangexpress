function removePath(filename) {
    let filenameArray = filename.split('/')
    const filenameWithoutPath = filenameArray.length

    filenameArray = filenameArray[filenameWithoutPath - 1]

    return filenameArray;
}

function previewImgUpload(elId, pathImg) {
    $(elId).attr('src', pathImg).removeClass('d-none')
}

export {removePath, previewImgUpload}