module tb_FA (Cout, Sum, A, B, Cin);

	input Cout, Sum;
	output A, B, Cin;
	
	reg A, B, Cin;

	initial begin
	#5 A=0; B=0; Cin=1;
	#5 A=1; B=1; Cin=1;
	#15 A=1; B=0; Cin=1;
	#20 A=1; B=1; Cin=0;
	end
	
	initial
	$monitor ("%d, A=%b, B=%b, Cin=%b, Sum=%b, Cout=%b", $time, A, B, Cin, Sum, Cout);
	
endmodule