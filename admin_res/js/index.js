function formatCurrency(input) {
    // Remove non-numeric characters
    var inputValue = input.value.replace(/[^0-9]/g, '');

    // Parse the numeric value
    var numericValue = parseInt(inputValue);

    // Format the number with commas
    var formattedValue = new Intl.NumberFormat('en-US').format(numericValue);

    // Update the input field with the formatted value
    input.value = formattedValue;
}
