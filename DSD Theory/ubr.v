module ubr (CK, DIN, Q);
	
	input CK;
	input [7:0] DIN;
	output [7:0] Q;
	
	reg [7:0] Q;
	
	always @ (negedge CK)
		Q <= DIN;	

endmodule
