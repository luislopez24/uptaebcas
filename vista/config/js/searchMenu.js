
document.querySelector("#verga").onkeyup = function(){
          $TableFilter("#tab", this.value);
          }
          
          $TableFilter = function(id, value){
              var rows = document.querySelectorAll(id + ' tbody tr');
              
              for(var i = 0; i < rows.length; i++){


                  var see = document.getElementById('tab');

                  var showRow = false;
                  
                  var row = rows[i];
                  row.style.display = 'none';
                  see.style.display = '';
                  
                  for(var x = 0; x < row.childElementCount; x++){
                      if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                          showRow = true;
                          break;
                      }
                  }
                  
                  if(showRow){
                      row.style.display = null;
                  }

                  if ($('#verga').val().length == 0) {
                  
                  
                  
                  see.style.display = 'none';
                  }

              }
          }


document.querySelector("#he2").onkeyup = function(){
          $TableFilter("#tab2", this.value);
          }
          
          $TableFilter = function(id, value){
              var rows = document.querySelectorAll(id + ' tbody tr');
              
              for(var i = 0; i < rows.length; i++){


                  var see = document.getElementById('tab2');

                  var showRow = false;
                  
                  var row = rows[i];
                  row.style.display = 'none';
                  see.style.display = '';
                  
                  for(var x = 0; x < row.childElementCount; x++){
                      if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                          showRow = true;
                          break;
                      }
                  }
                  
                  if(showRow){
                      row.style.display = null;
                  }

                  if ($('#he').val().length == 0) {
                  
                  
                  
                  see.style.display = 'none';
                  }

              }
          }