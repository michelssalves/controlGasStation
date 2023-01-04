<select class='form-select' aria-label='Default select example' name="status" id="status" multiple>
    <option value="1">NOVO</option>
    <option value="2">PEFIN</option>
    <option value="3">PAGO</option>
    <option value="4">BAIXADO</option>
    <option value="5">CANCELADO</option>
</select>
<script>
new MultiSelectTag('status', {
    rounded: true,    // default true
    shadow: true      // default false
})
</script>