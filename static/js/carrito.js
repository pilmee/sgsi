/**
**   Carro de compras base
**   Almacenamiento en memoria
**/

function Contenedor(){

	this.elementoContador  = 0;
	this.elementos         = new Array();
		
	this.agregar = function(elementoID,elementoDetalle,elementoValor,elementoPrecio,elemenetoCantidad,elementoDescuento){
		var detalle = new Array(elementoID,elementoDetalle,elementoValor,elementoPrecio,elemenetoCantidad,elementoDescuento);
		this.elementos.push(detalle);
		//console.log(this.elementos);
	};	

	this.eliminar = function(pos){
		//var pos = elementos[].indexOf( 'c' );
		console.log(pos);
		pos > -1 && this.elementos.splice(parseInt(pos),1);
		console.log(this.elementos);
	};

	this.consultar = function(){
		/*
		for(i=0;i<this.elementos.length;i++){
			for(j=0;j<this.this.elementos[i].length;j++){
				console.log("Elemento: "+this.elementos[i][j]);
			}
		}
		*/
		return this.elementos;
	};

	this.eliminarTodo = function(){
		delete this.elementos;
	};
};