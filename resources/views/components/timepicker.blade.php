<script>
    $(document).ready(function() {
        $(".timepicker").pDatepicker({
            "format": "H:m",
            "onlyTimePicker": true,
            "autoClose": true,
            "timePicker": {
                "enabled": true,
                "step": 1,
                "hour": {
                    "enabled": true,
                    "step": null
                },
                "minute": {
                    "enabled": true,
                    "step": null
                },
                "second": {
                    "enabled": false,
                    "step": null
                },
            }
        });
    });
</script>