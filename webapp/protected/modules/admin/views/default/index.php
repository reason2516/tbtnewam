<?php
$this->pageTitle = '后台首页';
?>
<script>
    function getRomanStr(index, value) {
        var romanStr = [
            ["M", "", ""],
            ["C", "D", "M"],
            ["X", "L", "C"],
            ["I", "V", "X"]
        ];
        var returnVal = "";
        switch (value) {
            case "1":
                returnVal = romanStr[index][0];
                break;
            case "2":
                returnVal = romanStr[index][0] + romanStr[index][0];
                break;
            case "3":
                returnVal = romanStr[index][0] + romanStr[index][0] + romanStr[index][0];
                break;
            case "4":
                returnVal = romanStr[index][0] + romanStr[index][1];
                break;
            case "5":
                returnVal = romanStr[index][1];
                break;
            case "6":
                returnVal = romanStr[index][1] + romanStr[index][0];
                break;
            case "7":
                returnVal = romanStr[index][1] + romanStr[index][0] + romanStr[index][0];
                break;
            case "8":
                returnVal = romanStr[index][1] + romanStr[index][0] + romanStr[index][0] + romanStr[index][0];
                break;
            case "9":
                returnVal = romanStr[index][0] + romanStr[index][2];
                break;
            default:
                break;
        }
        return returnVal;
    }

    function numberToRoman(number) {
        if (isNaN(number)) {
            return "illegal number";
        }
        if (number > 3999 || number < 0) {
            return "number out of range";
        }
        number = number.toString(); // toString
        var retRoman = "";
        for (var i = number.length - 1; i >= 0; i--) {
            retRoman = getRomanStr(i, number[i]) + retRoman;
        }
        return retRoman;
    }

    console.log(numberToRoman(3999));
</script>