module test_cbr;

	reg CK, LD, CLR;
	reg [7:0] DIN;
	wire [7:0] Q;
	
	cbr r1 (CK, DIN, Q, LD, CLR);
	
	always
		#3 CK = ~CK;
		
	initial 
		begin
			CK = 0;
			DIN = 8'b10101010;
			#20 DIN = 8'hFF;
			#5 DIN = 8'hAB;
						
		end
	initial 
		begin
			LD = 0;
			CLR = 0;
			#10 LD = 1;
			#5 CLR = 1;
			#12 LD = 0;
			
		end

endmodule
