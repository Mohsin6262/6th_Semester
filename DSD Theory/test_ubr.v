module test_ubr;

	reg CK;
	reg [7:0] DIN;
	wire [7:0] Q;
	
	ubr r1 (CK, DIN, Q);
	
	always
		#3 CK = ~CK;
		
	initial 
	begin
		CK = 0;
		#5 DIN = 8'b10101010;
		#8 DIN = 8'b11110000;
		#17 DIN = 8'b00001111;			
	end

endmodule