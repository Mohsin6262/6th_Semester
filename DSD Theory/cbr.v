module cbr (CK, DIN, Q, LD, CLR);

	input CK, LD, CLR;
	input [7:0] DIN;
	output [7:0] Q;
	
	reg [7:0] Q;
	
	always @(negedge CK)
		if (~CLR)
			Q = 8'h00;
		else
			if (LD)
				Q = DIN;

endmodule