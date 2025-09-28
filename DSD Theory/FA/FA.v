module FA (Cout, Sum, A, B, Cin);
	
	output Cout, Sum;
	input A, B, Cin;

	wire s1, c1, c2;

	HA ha1 (s1, c1, A, B);
	HA ha2 (Sum, c2, s1, Cin);
	or o1 (Cout, c1, c2);

endmodule