module mod22Cntr(O, ck, rst); 

	input ck, rst; 
	output [4:0] O;  
	
	reg [4:0] O; 
 
	always @ (posedge ck)  
		if (~rst)  
			if (O == 5'd21) 
				O <= 5'd0;  
			else  
				O <= O+1; 
				   
	always @ (posedge rst)  
		O <= 5'd0; 
		 
endmodule