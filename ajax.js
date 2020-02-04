//creating request
function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
      
     if (!request) 
     //alert in case browser doesn't support
         alert("Your browser doesn't support Ajax!");
     else
         return request;
 }
  


  function alterar_preco_misto(valor) {

     var result = document.getElementById("resultado_preco_misto");
    //a gif to be showed when loading result
     result.innerHTML ='<center><img src="images/carregando.gif"/></center>';
     //valor_existente == existing_price
     var valor_existente = document.getElementById("preco_misto").value;//=price_mixed
     var unidade_misto = document.getElementById("unidade_misto").value;//=unit_mixed
     var quilo_misto = document.getElementById("quilo_misto").value;//=kg_mixed
    
     //quilo_misto = KG that is then multiplied by 25 and add to the original price
     valor_existente =parseFloat(unidade_misto)+(parseFloat(quilo_misto)*25)+valor;
     
     document.getElementById("preco_misto").value=valor_existente;
     result.innerHTML ="R$ "+valor_existente;

 }
   
  
 