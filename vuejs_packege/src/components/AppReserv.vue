<template>
    <div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">La Date </label>
            <input type="date" class="form-control" id="date"  >
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Default radio
            </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                <label class="form-check-label" for="exampleRadios2">
                    Second default radio
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
                <label class="form-check-label" for="exampleRadios3">
                    Disabled radio
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
                <label class="form-check-label" for="exampleRadios3">
                    Disabled radio
                </label>
            </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    </div>
   
</template>
<script>
export default {
    name: "AppReserv"
}
</script>