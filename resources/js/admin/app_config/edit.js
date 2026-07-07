function bindColorPicker(colorId, hexId) {
    const color = document.getElementById(colorId);
    const hex = document.getElementById(hexId);

    color.addEventListener('input', () => {
        hex.value = color.value;
    });

    hex.addEventListener('input', () => {
        if (/^#[0-9A-Fa-f]{6}$/.test(hex.value)) {
            color.value = hex.value;
        }
    });
}

bindColorPicker('primary_color', 'primary_color_hex');
bindColorPicker('secondary_color', 'secondary_color_hex');
bindColorPicker('sidebar_color_primary', 'sidebar_color_primary_hex');
bindColorPicker('sidebar_color_secondary', 'sidebar_color_secondary_hex');
bindColorPicker('background_color', 'background_color_hex');