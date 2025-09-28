module PISO_LSHIFT (CLK, CLR, SHL, DIN, Q);

	input CLK, CLR, SHL;
	input [7:0] DIN;
	output Q;
	
	reg Q;
	reg [7:0] SHIFTER;

	always @ (posedge CLK)
		if (CLR)
			SHIFTER = 8'b0;
		else
			if (~SHL)
				SHIFTER = DIN;
			else
				begin
					Q = SHIFTER[7];    
					SHIFTER = {SHIFTER[6:0], 1'b0};
				end
			
endmodule