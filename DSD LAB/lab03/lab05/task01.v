`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date:    12:46:54 03/23/2025 
// Design Name: 
// Module Name:    task01 
// Project Name: 
// Target Devices: 
// Tool versions: 
// Description: 
//
// Dependencies: 
//
// Revision: 
// Revision 0.01 - File Created
// Additional Comments: 
//
//////////////////////////////////////////////////////////////////////////////////module RingCounter (CLK, RST, COUNT);

module BCDa(OUT, COUNT);
    input [3:0] COUNT;
    output reg [10:0] OUT;
    
    always @(*) begin
        case (COUNT)
            4'b0001: OUT = 11'b11110011011;
            4'b0010: OUT = 11'b01001001011;
            4'b0100: OUT = 11'b00110011011;
            4'b1000: OUT = 11'b00000001011;
            default: OUT = 11'b11111111111;
        endcase
    end
endmodule

module RingCounter_4bit(CLK, RST, COUNT);
    input CLK, RST;
    output reg [3:0] COUNT;
    
    always @(posedge CLK or posedge RST) begin
        if (RST)
            COUNT <= 4'b0001;
        else begin
            COUNT <= COUNT << 1;
            COUNT[0] <= COUNT[3]; 
        end
    end
endmodule

module top(CLK, RST, OUT);
    input CLK, RST;
    output [10:0] OUT;
    
    wire [3:0] COUNT;
    
    RingCounter rc(.CLK(CLK), .RST(RST), .COUNT(COUNT));
    BCDa bcd(.COUNT(COUNT), .OUT(OUT));
endmodule
