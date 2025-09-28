module test_PISO_LSHIFT;
	
	reg CLK, CLR, SHL;
	reg [7:0] DIN;
	wire Q;
		
	PISO_LSHIFT s1 (CLK, CLR, SHL, DIN, Q);
	
	always
		#5 CLK = ~CLK; 

	initial
		begin
			CLK = 1'b0; 
			CLR = 1'b1;
			DIN = 8'b10101101;
			#10 CLR = 1'b0;
			#5 SHL = 1'b0;	
			#6 SHL = 1'b1;
		end

endmodule