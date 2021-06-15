 //Preview image
 function readURL(input, $component) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $($component).css({ "display":"block" });
            $($component).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
