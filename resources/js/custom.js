$(document).ready(function(){

  //Autofocus in modal
  $('.modal').on('shown.bs.modal', function () {
    $('#insertId').focus()
  })
  function deleteElem(){
    
  }

  function clockTime(){
    var dateObject = new Date(); //has to be in the function in order for it to be updated every second.

    var time = document.getElementById('time');
    var hours = dateObject.getHours();
    var minutes = dateObject.getMinutes();
    //var seconds = dateObject.getSeconds();
    if(minutes < 10){
      minutes = "0" + minutes;
    }
    /*if(seconds < 10){
      seconds = "0" + seconds;
    }*/
    time.textContent = hours + " : " + minutes /* + " : " + seconds*/;
  }

  function todaysDate(){
    var dateObject = new Date();
    var nowDate = document.getElementById('todaysDate');
    var day = dateObject.getDay();
    var month = dateObject.getMonth();
    var date = dateObject.getDate();

    switch (day) {
      case 0:
        day = "Monday";
        break;
      case 1:
        day = "Tuesday";
        break;
      case 2:
        day = "Wednesday";
        break;
      case 3:
        day = "Thursday";
        break;
      case 4:
        day = "Friday";
        break;
      case 5:
        day = "Saturday";
        break;
      case 6:
        day = "Sunday";
        break;
      default:
        day = "Error parsing days";
    }
    switch (month) {
      case 0:
        month = "January";
        break;
      case 1:
        month = "February";
        break;
        case 2:
          month = "March";
          break;
        case 3:
          month = "April";
          break;
        case 4:
          month = "May";
          break;
        case 5:
          month = "June";
          break;
        case 6:
          month = "July";
          break;
        case 7:
          month = "August";
          break;
        case 8:
          month = "September";
          break;
        case 9:
          month = "October";
          break;
        case 10:
          month = "November";
          break;
        case 11:
          month = "December";
          break;
      default:
      month = "Error parsing months";
    }

    nowDate.textContent = day + " " + month + " " + date;
  }

  clockTime();
  setInterval(clockTime, 1000);
  todaysDate();

});
/*END OF FILE*/
