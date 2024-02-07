
$("input[data-type='currency']").keyup(function (e) {
    e.preventDefault();
    formatCurrency($(this));
});

$("input[data-type='currency']").blur(function (e) {
    e.preventDefault();
    formatCurrency($(this), "blur");
});

function formatCurrency(input, blur) {
    let input_val = input.val();

    if (input_val === "") {
        return;
    }

    const original_len = input_val.length;
    const caret_pos = input.prop("selectionStart");
    const decimal_pos = input_val.indexOf(".");

    let left_side = "";
    let right_side = "";

    if (decimal_pos >= 0) {
        left_side = formatNumber(input_val.substring(0, decimal_pos));
        right_side = formatNumber(input_val.substring(decimal_pos));

        if (blur === "blur") {
            right_side += "00";
        }

        right_side = right_side.substring(0, 2);

        input_val = `$${left_side}.${right_side}`;
    } else {
        input_val = formatNumber(input_val);
        input_val = `$${input_val}`;

        if (blur === "blur") {
            input_val += ".00";
        }
    }

    input.val(input_val);

    const updated_len = input_val.length;
    const new_caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(new_caret_pos, new_caret_pos);
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
